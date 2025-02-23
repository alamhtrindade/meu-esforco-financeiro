import {useState} from 'react';
import List from '@mui/material/List';
import ListItem from '@mui/material/ListItem';
import ListItemText from '@mui/material/ListItemText';
import ListItemAvatar from '@mui/material/ListItemAvatar';
import Avatar from '@mui/material/Avatar';
import AddIcon from '@mui/icons-material/Add';
import RemoveIcon from '@mui/icons-material/Remove';
import Button from '@mui/material/Button';
import { Box } from '@mui/material';
import FormCreateActivity from '../FormCreateActivity/FormCreateActivity';

const CardList = ({
    title,
    activities,
    idSelectedPerson,
    type,
    setReload
}) => {

    const [showModal, setShowModal] = useState(false);
    const [typeActivity, setTypeActivity] = useState(type);

    const handleShowModal = () => {
        setShowModal(true)
    }

    return (
        <>
            <FormCreateActivity
                type={typeActivity}
                open={showModal}
                setOpen={setShowModal}
                idSelectedPerson={idSelectedPerson}
                setReload={setReload}
            />
            <List
                sx={{
                    width: "100%",
                    minWidth: 200,
                    maxWidth: 460,
                    minHeight: 300,
                    paddingX: 6,
                    paddingY: 4,
                    bgcolor: "#fcfbf9",
                    borderRadius: "20px",
                    boxShadow: "0px 2px 10px rgba(0, 0, 0, 0.1)",
                    border: "1px solid rgba(0, 0, 0, 0.1)",
                    display: "flex",
                    flexDirection: "column",
                    justifyContent: "space-between",
                }}
            >
                <h3> { title }</h3>
                <Box sx={{ flexGrow: 1 }}>
                    {activities.map((activity) => (
                        <ListItem key={activity.id_person_income ? activity.id_person_income : activity.id_person_expense }>
                            <ListItemAvatar>
                                <Avatar>
                                    {activity.type === "credited" ? (
                                        <AddIcon fontSize="small" />
                                    ) : (
                                        <RemoveIcon fontSize="small" />
                                    )}
                                </Avatar>
                            </ListItemAvatar>
                            <ListItemText
                                primary={`€ ${activity.type === "credited" ? "" : "-"}${activity.value}`}
                                secondary={activity.date}
                            />
                        </ListItem>
                    ))}
                </Box>

                <Box sx={{ display: "flex", justifyContent: "flex-end", paddingTop: 2 }}>
                    <Button
                        variant="contained"
                        style={{
                            backgroundColor: "#566480",
                            borderRadius: "50%",
                            width: 30,
                            height: 30,
                            minWidth: 30,
                            padding: 0,
                            display: "flex",
                            alignItems: "center",
                            justifyContent: "center",
                        }}
                        onClick={() => handleShowModal()}
                    >
                        <AddIcon fontSize="small" style={{ fontSize: 24 }} />
                    </Button>
                </Box>
            </List>
        </>
        
    )
}

export default CardList