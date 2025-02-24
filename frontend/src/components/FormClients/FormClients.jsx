import { useState } from "react";
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';
import Button from '@mui/material/Button';
import Stack from '@mui/material/Stack';
import AddIcon from '@mui/icons-material/Add';
import ModalCreateClient from "../ModalCreateClient/ModalCreateClient";

const MOUNTHS = [
    { id: 1, mounth: 'Janeiro'},
    { id: 2, mounth: 'Fevereiro'},
    { id: 3, mounth: 'Março'},
    { id: 4, mounth: 'Abril'},
    { id: 5, mounth: 'Maio'},
    { id: 6, mounth: 'Junho'},
    { id: 7, mounth: 'Julho'},
    { id: 8, mounth: 'Agosto'},
    { id: 9, mounth: 'Setembro'},
    { id: 10, mounth: 'Outubro'},
    { id: 11, mounth: 'Novembro'},
    { id: 12, mounth: 'Dezembro'}
];

const FormClients = ({
    clients,
    setClients,
    selectedClient,
    setSelectedClient,
    selectedMounth,
    setSelectedMounth,
    disableSelectMount,
    setModifiedMonth,
    setReload
}) => {

    const CLIENTS = clients;
    const [open, setOpen] = useState(false);

    const handleOpen = () => {
        setOpen(true)
    }

    const handleSelectedMounth = (month) => {
        setSelectedMounth(month)
        setModifiedMonth(true);
    }
    return (
        <>
            <ModalCreateClient
                clients={clients}
                setClients={setClients}
                setSelectedClient={setSelectedClient}
                open={open}
                setOpen={setOpen}
                setReload={setReload}
            />
            <Stack
                spacing={2}
                direction="row"
                style={{
                    alignContent: "center",
                }}
            >
                <FormControl fullWidth style={{ marginBottom: "10px"}}>
                    <InputLabel id="client-select-label" >Cliente</InputLabel>
                    <Select
                        labelId="client-select-label"
                        id="client-select"
                        value={selectedClient || ""}
                        onChange={(e) => setSelectedClient(e.target.value)}
                    >
                        {(CLIENTS || []).map(client => (
                            <MenuItem key={client.id_person} value={client}>
                                {client.name} ({client.nif})
                            </MenuItem>
                        ))}

                    </Select>
                </FormControl>
                <Button
                    variant="contained"
                    style={{
                        backgroundColor: "#566480",
                        borderRadius: "50%",
                        width: 50,
                        height: 50,
                        minWidth: 50,
                        padding: 0,
                        display: "flex",
                        alignItems: "center",
                        justifyContent: "center",
                    }}
                    onClick={() => handleOpen()}
                >
                    <AddIcon fontSize="small" style={{ fontSize: 24 }} />
                </Button>
            </Stack>
            <Stack
                spacing={2}
                direction="row"
                style={{
                    alignContent: "center",
                }}
            >
                <FormControl fullWidth style={{ marginBottom: "60px", marginRight: "65px"}}>
                    <InputLabel id="mounth-select-label" >Mês Referência</InputLabel>
                    <Select
                        labelId="mounth-select-label"
                        id="mounth-select"
                        value={selectedMounth}
                        onChange={(e) => handleSelectedMounth(e.target.value)}
                        disabled={disableSelectMount}
                    >
                        {MOUNTHS.map(mounth => (
                            <MenuItem key={mounth.id} value={mounth.id}>
                                {mounth.mounth}
                            </MenuItem>
                        ))}
                    </Select>
                </FormControl>
            </Stack>
        </>
        
    )
}

export default FormClients