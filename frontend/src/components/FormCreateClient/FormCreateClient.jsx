import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import Modal from '@mui/material/Modal';
import { useState } from 'react';
import { Button, TextField, Grid } from '@mui/material';
import { createPerson } from '../../services/PersonService';

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

const FormCreateClient = ({ 
    clients,
    setClients,
    setSelectedClient,
    open,
    setOpen,
    setReload
}) => {
    const [name, setName] = useState("");
    const [nif, setNif] = useState("");
    
    const handleClose = () => setOpen(false);

    const handleSaveNewClient = async () => {
        try {
            
            createPerson( name, nif)
                .then(response => {
                    const data = response;

                    const newClient = {
                        id_person: data.id_person,
                        nif: data.nif,
                        name: data.name,
                        credited: [],
                        debited: []
                    };
        
                    setClients([...clients, newClient]);
                    setSelectedClient(newClient);
                    setName("");
                    setNif("");
                    setReload(true);
                    handleClose();
                })
                .catch(error => {
                    console.error("Erro ao buscar clientes:", error);
                });
        } catch (error) {
            console.error("Erro ao enviar requisição:", error);
        }
    }

    return (
        <Modal
            open={open}
            onClose={handleClose}
        >
            <Box sx={style}>
                <Typography variant="h6" component="h2" gutterBottom sx={{ textAlign: "center", fontWeight: "bold" }}>
                    Cadastrar Novo Cliente
                </Typography>
                
                <Grid container spacing={2}>
                    <Grid item xs={12}>
                        <TextField 
                            fullWidth 
                            label="Número NIF" 
                            variant="outlined" 
                            value={nif}
                            onChange={(e) => setNif(e.target.value)}
                        />
                    </Grid>
                    <Grid item xs={12}>
                        <TextField 
                            fullWidth 
                            label="Nome Completo" 
                            variant="outlined" 
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                        />
                    </Grid>
                </Grid>

                <Grid container spacing={2} sx={{ mt: 3, justifyContent: "flex-end" }}>
                    <Grid item>
                        <Button variant="outlined" color="error" onClick={handleClose}>
                            Cancelar
                        </Button>
                    </Grid>
                    <Grid item>
                        <Button variant="contained" color="success" onClick={handleSaveNewClient}>
                            Salvar
                        </Button>
                    </Grid>
                </Grid>
            </Box>
        </Modal>
    );
};

export default FormCreateClient;
