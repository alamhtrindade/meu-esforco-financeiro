import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import Modal from '@mui/material/Modal';
import { useState } from 'react';
import { Button, TextField, Grid, CircularProgress } from '@mui/material';
import { LocalizationProvider } from '@mui/x-date-pickers/LocalizationProvider';
import { AdapterDateFns } from '@mui/x-date-pickers/AdapterDateFns';
import { DatePicker } from '@mui/x-date-pickers/DatePicker';
import { createIncome, createExpense } from '../../services/PersonService';
import { format } from "date-fns";
import Alert from '../Alert/Alert';

const style = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: 600,
  bgcolor: 'background.paper',
  borderRadius: "12px",
  boxShadow: 24,
  p: 4,
};

const FormCreateActivity = ({
    type,
    open,
    setOpen,
    idSelectedPerson,
    setReload
}) => {
  
    const [value, setValue] = useState("");
    const [dateActivity, setDateActivity] = useState(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);
    const [typeError, setTypeError] = useState("");
    const [descError, setDescError] = useState("");

    const setModalErro = (typeError, error) => {
        setTypeError(typeError)
        setDescError(error)
        setError(true)

        setTimeout(() => {
            setError(false)
            setTypeError("")
            setDescError("")
        }, 3000);
    }
    
    const handleClose = () => {
        setReload(true);
        setOpen(false);
    }

    const handleSubmitActivity = () => {

        setLoading(true);

        if(!value || !dateActivity){
            setModalErro("Preencha todos os campos", "Todos os campos são obrigatórios.");
            setLoading(false)
            return;
        }

        const formattedDate = format(dateActivity, "yyyy-MM-dd");

        const data = {
            idPerson: idSelectedPerson,
            value: value,
            date_income: type === 'credit' ? formattedDate : undefined,
            date_expense: type === 'debit' ? formattedDate : undefined
        };

        if(type === 'credit'){
            createIncome(data)
                .then(() => {
                    setValue("")
                    setDateActivity("")
                })
                .catch(error => {
                    console.error("Erro ao cadastrar Entradas:", error);
                    setModalErro("Ocorreu um erro", "Os valores devem ser numéricos com 2 casas decimais")
                })
                .finally(() => {
                    setLoading(false);
                });
        }else{
            createExpense(data)
                .then(() => {
                    setValue("")
                    setDateActivity("")
                })
                .catch(error => {
                    console.error("Erro ao cadastrar Saídas:", error);
                    setModalErro("Ocorreu um erro", "Os valores devem ser numéricos com 2 casas decimais")
                })
                .finally(() => {
                    setLoading(false);
                });
        }
    };

    return (
        <>
            <Alert
                title={typeError}
                value={descError}
                open={error}
                setOpen={setError}
            />
            <Modal open={open} onClose={handleClose}>
                <Box sx={style}>
                
                    <Typography variant="h6" component="h2" gutterBottom sx={{ textAlign: "center", fontWeight: "bold" }}>
                        {type === "credit" ? "Cadastrar Rendimento" : "Cadastrar Despesa"}
                    </Typography>
                    <Grid container spacing={2}>
                        <Grid item xs={7}>
                            <TextField 
                                fullWidth 
                                label="Valor" 
                                variant="outlined" 
                                value={value}
                                onChange={(e) => setValue(e.target.value)}
                            />
                        </Grid>
                        <Grid item xs={5}>
                            <LocalizationProvider dateAdapter={AdapterDateFns}>
                                <DatePicker
                                    label="Data"
                                    value={dateActivity}
                                    onChange={(newValue) => setDateActivity(newValue)}
                                    renderInput={(params) => <TextField {...params} fullWidth />}
                                />
                            </LocalizationProvider>
                        </Grid>
                    </Grid>

                    <Grid container spacing={2} sx={{ mt: 3, justifyContent: "flex-end" }}>
                        <Grid item>
                            <Button variant="outlined" color="error" onClick={handleClose} disabled={loading}>
                                Cancelar
                            </Button>
                        </Grid>
                        <Grid item>
                            <Button 
                                variant="contained" 
                                color="success" 
                                onClick={handleSubmitActivity} 
                                disabled={loading} 
                                startIcon={loading ? <CircularProgress size={20} color="inherit" /> : null}
                            >
                                {loading ? "Salvando..." : "Salvar"}
                            </Button>
                        </Grid>
                    </Grid>
                </Box>
            </Modal>
        </>
    );
};

export default FormCreateActivity;
