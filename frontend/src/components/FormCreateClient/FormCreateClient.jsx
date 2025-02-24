import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import { Button, TextField, Grid } from '@mui/material';

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
    nif,
    setNif,
    name,
    setName,
    handleClose,
    handleNewClient
}) => {
    
    return (
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
                <Button variant="contained" color="success" onClick={handleNewClient}>
                    Salvar
                </Button>
                </Grid>
            </Grid>
        </Box>
    );
};

export default FormCreateClient;
