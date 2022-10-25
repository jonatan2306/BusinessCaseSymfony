import React, { useState } from 'react';

// material-ui
import {
    Avatar,
    AvatarGroup,
    Box,
    Button,
    Grid,
    List,
    ListItemAvatar,
    ListItemButton,
    ListItemSecondaryAction,
    ListItemText,
    MenuItem,
    Stack,
    TextField,
    Typography
} from '@mui/material';

// project import
import IncomeAreaChart from './IncomeAreaChart';
import MonthlyBarChart from './MonthlyBarChart';
import MainCard from '../../../components/MainCard';
import AnalyticEcommerce from '../../../components/cards/statistics/AnalyticEcommerce';

// assets
import avatar1 from '../../../assets/images/users/avatar-1.png';
import avatar2 from '../../../assets/images/users/avatar-2.png';
import avatar3 from '../../../assets/images/users/avatar-3.png';
import avatar4 from '../../../assets/images/users/avatar-4.png';

// avatar style
const avatarSX = {
    width: 36,
    height: 36,
    fontSize: '1rem'
};

// action style
const actionSX = {
    mt: 0.75,
    ml: 1,
    top: 'auto',
    right: 'auto',
    alignSelf: 'flex-start',
    transform: 'none'
};

// sales report status
const status = [
    {
        value: 'today',
        label: 'Today'
    },
    {
        value: 'month',
        label: 'This Month'
    },
    {
        value: 'year',
        label: 'This Year'
    }
];

// ==============================|| DASHBOARD - DEFAULT ||============================== //

const DashboardDefault = (props) => {
    const { data } = props
    const [value, setValue] = useState('today');
    const [slot, setSlot] = useState('week');
    console.log('DashboardDefault', data)
    return (
        <Grid container rowSpacing={4.5} columnSpacing={2.75}>
            {/* row 1 */}
            <Grid item xs={12} sx={{ mb: -2.25 }}>
                <Typography variant="h5">Dashboard</Typography>
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="% Conversion commandes" count={parseFloat(data.conversion_commandes).toFixed(2)} />
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="Nombres de commandes" count={data.nombre_commandes}  />
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="Nombre de panier" count={data.nombre_paniers}  />
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="Valeur panier moyen (€)" count={data.panier_moyen} />
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="% de panier abandonnés" count={data.panier_abandon} />
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="Nouveaux client" count={data.new_client_today}  />
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="Montant total des ventes (€)" count={data.montant_total_ventes}  />
            </Grid>
            <Grid item xs={2} sm={4} md={4}>
                <AnalyticEcommerce title="Nombre de visiteurs" count={data.counter_visitor}  />
            </Grid>
            <Grid item md={8} sx={{ display: { sm: 'none', md: 'block', lg: 'none' } }} />

            <Grid item xs={12} md={5} lg={4}>
                <MainCard sx={{ mt: 2 }}>
                    <Stack spacing={3}>
                        <Grid container justifyContent="space-between" alignItems="center">
                            <Grid item>
                                <Stack>
                                    <Typography variant="h5" noWrap>
                                        Help & Support Chat
                                    </Typography>
                                    <Typography variant="caption" color="secondary" noWrap>
                                        Typical replay within 5 min
                                    </Typography>
                                </Stack>
                            </Grid>
                            <Grid item>
                                <AvatarGroup sx={{ '& .MuiAvatar-root': { width: 32, height: 32 } }}>
                                    <Avatar alt="Remy Sharp" src={avatar1} />
                                    <Avatar alt="Travis Howard" src={avatar2} />
                                    <Avatar alt="Cindy Baker" src={avatar3} />
                                    <Avatar alt="Agnes Walker" src={avatar4} />
                                </AvatarGroup>
                            </Grid>
                        </Grid>
                        <Button size="small" variant="contained" sx={{ textTransform: 'capitalize' }}>
                            Need Help?
                        </Button>
                    </Stack>
                </MainCard>
            </Grid>
        </Grid>
    );
};

export default DashboardDefault;
