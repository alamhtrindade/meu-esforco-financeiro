import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import Modal from '@mui/material/Modal';
import { useState } from 'react';
import { Button, TextField, Grid } from '@mui/material';
import { createPerson } from '../../services/PersonService';
import FormCreateClient from '../FormCreateClient/FormCreateClient';
import Alert from '../Alert/Alert';

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

const ModalCreateClient = ({ 
    clients,
    setClients,
    setSelectedClient,
    open,
    setOpen,
    setReload
}) => {
    const [name, setName] = useState("");
    const [nif, setNif] = useState("");
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
    
    const handleClose = () => setOpen(false);

    const handleNewClient = async () => {
        try {
            
            if(!name || !nif){
                setModalErro("Campos Obrigatórios", 'Preencha todos os campos antes de continuar');
                return;
            }
            
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
                    setModalErro("Ocorreu um erro", "Verifique o NIF que pode já estar cadastrado.")
                });
        } catch (error) {
            console.error("Erro ao enviar requisição:", error);
            setModalErro("Ocorreu um erro", "Erro na requisição")
        }
    }

    return (
        <>
            <Alert
                title={typeError}
                value={descError}
                open={error}
                setOpen={setError}
            />

            <Modal
                open={open}
                onClose={handleClose}
            >
                <FormCreateClient
                    nif={nif}
                    setNif={setNif}
                    name={name}
                    setName={setName}
                    handleClose={handleClose}
                    handleNewClient={handleNewClient}
                />
            </Modal>
        </>
    );
};

export default ModalCreateClient;
