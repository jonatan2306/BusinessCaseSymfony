import React from 'react';
// material-ui
import {Box, Container, Toolbar} from '@mui/material';

// project import
import Header from './Header';
import navigation from '../../menu-items';
import Breadcrumbs from '../../components/@extended/Breadcrumbs';
import {Outlet} from "react-router-dom";
import Dashboard from "./Dashboard";

// ==============================|| MAIN LAYOUT ||============================== //
const MainLayout = () => {
    return (
        <Box sx={{ width: '100%' }}>
            <Box sx={{ display: 'flex', width: '100%' }}>
                <Header />
                <Box component="main" sx={{ width: '100%', flexGrow: 1, p: { xs: 2, sm: 3 } }}>
                    <Toolbar />
                </Box>
            </Box>
            <Container>
                <Dashboard />
            </Container>
        </Box>
    );
};

export default MainLayout;
