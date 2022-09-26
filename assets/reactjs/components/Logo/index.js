import React from 'react';

import PropTypes from 'prop-types';

// material-ui
import { ButtonBase } from '@mui/material';

// project import
import Logo from './Logo';
import config from '../../config';

// ==============================|| MAIN LOGO ||============================== //

const LogoSection = ({ sx, to }) => (
    <ButtonBase disableRipple sx={sx}>
        <Logo />
    </ButtonBase>
);

LogoSection.propTypes = {
    sx: PropTypes.object,
    to: PropTypes.string
};

export default LogoSection;
