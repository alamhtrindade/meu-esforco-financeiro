import { useState, useEffect } from "react";
import CardRatio from "../../components/CardRatio/CardRatio";
import CardList from "../../components/CardList/CardList";
import FormClients from "../../components/FormClients/FormClients";
import { Grid, Container, Typography, TextField, Button } from '@mui/material';
import CardActivitie from "../../components/CardActivitie/CardActivitie";
import { CircularProgress, Box } from "@mui/material";
import { getAll, getByPersonAndMonth, createPerson } from '../../services/PersonService';
import FormCreateClient from "../../components/FormCreateClient/FormCreateClient";
import Alert from "../../components/Alert/Alert";

const style = {
    position: 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: 400,
    bgcolor: 'background.paper',
    borderRadius: "12px",
    boxShadow: 24,
    p: 4,
};

const Home = () => {
    const mesAtual = new Date().getMonth();
    const [totalCredited, setTotalCredited] = useState(0);
    const [totalDebited, setTotalDebited] = useState(0);
    const [data, setData] = useState([]);
    const [total, setTotal] = useState(0);
    const [effortRate, setEffortRate] = useState(0);
    const [dataClients, setDataClients] = useState([]);
    const [selectedClient, setSelectedClient] = useState(null);
    const [selectedMounth, setSelectedMounth] = useState(mesAtual + 1);
    const [disableSelectMount, setDisableSelectMount] = useState(false);
    const [dataActivities, setDataAtivities] = useState([]);
    const [loading, setLoading] = useState(true);
    const [modifiedMonth, setModifiedMonth] = useState(false);
    const [reload, setReload] = useState(false);
    const [newClientNif, setNewClientNif] = useState("");
    const [newClientName, setNewClientName] = useState("");
    const [open, setOpen] = useState(false);
    const [typeError, setTypeError] = useState("");
    const [descError, setDescError] = useState("");

    const setModalErro = (typeError, error) => {
        setTypeError(typeError)
        setDescError(error)
        setOpen(true)

        setTimeout(() => {
            setOpen(false)
            setTypeError("")
            setDescError("")
        }, 3000);
    }

    useEffect(() => {
        getAll()
            .then(response => {
                setDataClients(response);
                setSelectedClient(response[0] || null);
            })
            .catch(error => {
                console.error("Erro ao buscar clientes:", error);
                setModalErro("Ocorreu um erro", "Erro ao buscar dados na API")
            })
            .finally(() => {
                setLoading(false);
            });
    }, []);

    useEffect(() => {
        const mesAtual = new Date().getMonth() + 1;

        if (selectedClient) {

            const creditedTotal = selectedClient.credited?.reduce(
                (acc, transaction) => acc + parseFloat(transaction.value), 0
            ) || 0;
    
            const debitedTotal = selectedClient.debited?.reduce(
                (acc, transaction) => acc + parseFloat(transaction.value), 0
            ) || 0;
    
            setTotalCredited(parseFloat(creditedTotal.toFixed(2)));
            setTotalDebited(parseFloat(debitedTotal.toFixed(2)));
    
            const totalAmount = creditedTotal - debitedTotal;
            setTotal(parseFloat(totalAmount.toFixed(2)));
    
            setData([
                { label: 'Credited', value: creditedTotal },
                { label: 'Debited', value: debitedTotal }
            ]);
    
            setEffortRate(creditedTotal > 0 ? Math.round((debitedTotal / creditedTotal) * 100) : 0);
    
            setDataAtivities([
                {
                    title: 'Entradas',
                    value: `€ ${creditedTotal.toFixed(2)}`,
                    interval: 'Últimos 30 dias',
                    trend: 'up',
                    data: selectedClient.credited || []
                },
                {
                    title: 'Saídas',
                    value: `€ -${debitedTotal.toFixed(2)}`,
                    interval: 'Últimos 30 dias',
                    trend: 'down',
                    data: selectedClient.debited || []
                }
            ]);
            setSelectedMounth(mesAtual);
        }
    }, [selectedClient]);

    useEffect( () => {
        if(modifiedMonth || reload){
            if(selectedClient){
                setLoading(true);
                getByPersonAndMonth(selectedClient.id_person, selectedMounth)
                    .then(response => {
    
                        const creditedTotal = response.credited?.reduce(
                            (acc, transaction) => acc + parseFloat(transaction.value), 0
                        ) || 0;
                
                        const debitedTotal = response.debited?.reduce(
                            (acc, transaction) => acc + parseFloat(transaction.value), 0
                        ) || 0;
                
                        setTotalCredited(parseFloat(creditedTotal.toFixed(2)));
                        setTotalDebited(parseFloat(debitedTotal.toFixed(2)));
                
                        const totalAmount = creditedTotal - debitedTotal;
                        setTotal(parseFloat(totalAmount.toFixed(2)));
                
                        setData([
                            { label: 'Credited', value: creditedTotal },
                            { label: 'Debited', value: debitedTotal }
                        ]);
                
                        setEffortRate(creditedTotal > 0 ? Math.round((debitedTotal / creditedTotal) * 100) : 0);
                
                        setDataAtivities([
                            {
                                title: 'Entradas',
                                value: `€ ${creditedTotal.toFixed(2)}`,
                                interval: 'Últimos 30 dias',
                                trend: 'up',
                                data: response.credited || []
                            },
                            {
                                title: 'Saídas',
                                value: `€ -${debitedTotal.toFixed(2)}`,
                                interval: 'Últimos 30 dias',
                                trend: 'down',
                                data: response.debited || []
                            }
                        ]);

                        let client = selectedClient;

                        client.credited = [];
                        client.debited = [];
                        client.credited = response.credited;
                        client.debited = response.debited;

                        setModifiedMonth(false);
                        setSelectedClient(client);
                        setReload(false);
                        
                    })
                    .catch(error => {
                        console.error("Erro ao buscar clientes:", error);
                        setModalErro("Ocorreu um erro", "ocorreu um erro ao buscar clientes na API")
                    })
                    .finally(() => {
                        setLoading(false);
                    });
            }
        }
    }, [modifiedMonth, reload]);

    const handleSaveNewClient = () => {

        try {
            if(!newClientName || !newClientNif){
                setModalErro("Campos Obrigatórios", 'Preencha todos os campos antes de continuar');
                return;
            }
            createPerson( newClientName, newClientNif)
                .then(response => {
                    const data = response;

                    const newClient = {
                        id_person: data.id_person,
                        nif: data.nif,
                        name: data.name,
                        credited: [],
                        debited: []
                    };
        
                    setDataClients([newClient]);
                    setSelectedClient(newClient);
                    setReload(true);

                })
                .catch(error => {
                    console.error("Erro ao cadastrar cliente:", error);
                    setModalErro("Cadastro de Clientes", "Verifique se o NIF já possui cadastro.")
                });
        } catch (error) {
            console.error("Erro ao enviar requisição:", error);
            setModalErro("Erro na Requisição", "Algo saiu mal! Tente novamente mais tarde.")
        }
    };

    return (
        <>
            <Alert
                title={typeError}
                value={descError}
                open={open}
                setOpen={setOpen}
            />

            {loading ? (
                <Box display="flex" flexDirection="column" alignItems="center" mt={4}>
                    <CircularProgress size={50} color="primary" />
                    <Typography variant="body1" mt={2}>Carregando clientes...</Typography>
                </Box>
            ) : (
                <>
                    { dataClients.length === 0 ? (
                        <FormCreateClient 
                            nif={newClientNif}
                            setNif={setNewClientNif}
                            name={newClientName}
                            setName={setNewClientName}
                            handleClose={() => {}}
                            handleNewClient={handleSaveNewClient}
                        />
                    ) : (
                        <>
                            <FormClients
                                clients={dataClients}
                                setClients={setDataClients}
                                selectedClient={selectedClient}
                                setSelectedClient={setSelectedClient}
                                selectedMounth={selectedMounth}
                                setSelectedMounth={setSelectedMounth}
                                disableSelectMount={disableSelectMount}
                                setModifiedMonth={setModifiedMonth}
                                setReload={setReload}
                            />
                            <Container style={{ marginBottom: "60px", paddingLeft: 0, textAlign: "center" }}>
                                <Grid container spacing={3}>
                                    {dataActivities.map((activity, index) => (
                                        <Grid item xs={12} sm={6} md={4} key={index}>
                                            <CardActivitie
                                                title={activity.title}
                                                value={activity.value}
                                                interval={activity.interval}
                                                trend={activity.trend}
                                                data={activity.data}
                                            />
                                        </Grid>
                                    ))}
                                    <Grid item xs={12} sm={6} md={4}>
                                        <Typography component="h2" variant="h6" gutterBottom style={{ marginBottom: "30px" }}>
                                            Taxa de Esforço
                                        </Typography>
                                        <Typography component="h1" variant="h4" gutterBottom style={{ marginBottom: "20px" }}>
                                            {effortRate}%
                                        </Typography>
                                        <Typography component="h2" variant="subtitle1" gutterBottom>
                                            Risco: <span style={{ color: effortRate < 50 ? "#2E7D32" : "#D32F2F" }}>
                                                {effortRate < 50 ? "Aceitável" : "Alto"}
                                            </span>
                                        </Typography>
                                    </Grid>
                                </Grid>
                            </Container>
                            <div style={{ display: "flex", gap: "16px" }}>
                                {selectedClient&&(
                                    <>
                                        <CardList
                                            title="Entradas"
                                            activities={selectedClient.credited || []}
                                            idSelectedPerson={selectedClient.id_person}
                                            type="credit"
                                            setReload={setReload}
                                        />
                                        <CardList
                                            title="Saídas"
                                            activities={selectedClient.debited || []}
                                            idSelectedPerson={selectedClient.id_person}
                                            type="debit"
                                            setReload={setReload}
                                        />
                                        <CardRatio data={data} total={total} />
                                    </>
                                )}
                            </div>
                        </>
                    )}
                </>
            )}
        </>
    );
}

export default Home;
