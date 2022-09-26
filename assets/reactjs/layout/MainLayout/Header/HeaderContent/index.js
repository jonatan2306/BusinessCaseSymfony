import React from 'react';
// material-ui
import { Box, Chip, Stack, useMediaQuery } from '@mui/material';

// project import
import Search from './Search';
import Profile from './Profile';
import MobileSection from './MobileSection';
import Logo from '../../../../components/Logo';

// ==============================|| HEADER - CONTENT ||============================== //

const HeaderContent = () => {
    const matchesXs = useMediaQuery((theme) => theme.breakpoints.down('md'));

    return (
        <>
            <Stack direction="row" spacing={1} alignItems="center">
                <Logo />
                <Chip
                    label={"v1.0.0"}
                    size="small"
                    sx={{ height: 16, '& .MuiChip-label': { fontSize: '0.625rem', py: 0.25 } }}
                    component="a"
                    href="https://github.com/codedthemes/mantis-free-react-admin-template"
                    target="_blank"
                    clickable
                />
            </Stack>
            {!matchesXs && <Search />}
            {matchesXs && <Box sx={{ width: '100%', ml: 1 }} />}
            {!matchesXs && <Profile />}
            {matchesXs && <MobileSection />}
        </>
    );
};

export default HeaderContent;
