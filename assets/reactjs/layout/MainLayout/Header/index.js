import React from 'react';

import PropTypes from 'prop-types';

// material-ui
import { useTheme } from '@mui/material/styles';
import { AppBar, Toolbar } from '@mui/material';
import HeaderContent from "./HeaderContent";


// ==============================|| MAIN LAYOUT - HEADER ||============================== //

const Header = () => {
    const theme = useTheme();

    // common header
    const mainHeader = (
        <Toolbar>
            <HeaderContent />
        </Toolbar>
    );

    // app-bar params
    const appBar = {
        position: 'fixed',
        color: 'inherit',
        elevation: 0,
        sx: {
            borderBottom: `1px solid ${theme.palette.divider}`
            // boxShadow: theme.customShadows.z1
        }
    };

    return (
        <>
            <AppBar {...appBar}>{mainHeader}</AppBar>
        </>
    );
};

Header.propTypes = {
    open: PropTypes.bool,
    handleDrawerToggle: PropTypes.func
};

export default Header;
