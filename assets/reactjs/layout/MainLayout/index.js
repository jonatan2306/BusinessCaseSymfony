import React from 'react';
// material-ui
import { Box, Toolbar } from '@mui/material';

// project import
import Header from './Header';
import navigation from '../../menu-items';
import Breadcrumbs from '../../components/@extended/Breadcrumbs';
import {Outlet} from "react-router-dom";



// ==============================|| MAIN LAYOUT ||============================== //

const MainLayout = () => {
    return (
        <Box sx={{ display: 'flex', width: '100%' }}>
            <Header />
            <Box component="main" sx={{ width: '100%', flexGrow: 1, p: { xs: 2, sm: 3 } }}>
                <Toolbar />
            </Box>
        </Box>
    );
};

export default MainLayout;
