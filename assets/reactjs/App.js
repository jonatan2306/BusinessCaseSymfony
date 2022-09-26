import React from "react";
import ThemeCustomization from './themes';
import MainLayout from "./layout/MainLayout";

// creer du contenu html
const App = () => {
    return (
        <ThemeCustomization>
            <MainLayout />
        </ThemeCustomization>
    )
}
export default App;
