import React, {useEffect, useState} from "react";
import ThemeCustomization from './themes';
import MainLayout from "./layout/MainLayout";

// creer du contenu html
const App = () => {
    const [data, setData] = useState({});
    // get data from api symfony 
 
    useEffect(() => {
        getApiDashboard();
    }, [])
    const getApiDashboard = async () => {
        try {
            const response = await fetch('http://127.0.0.1:8000/api',{
                method: 'GET',
            //   mode: 'no-cors', 
              headers: {
                // 'Content-Type': 'application/json',
                Accept: 'application/json',
              },
             
            });
            const result = await response.json();
            setData(result)
        } catch(e){
            console.log('e', e.message)
        }
        
    }
    return (
        <ThemeCustomization>
            <MainLayout data={data} />
        </ThemeCustomization>
    )
}
export default App;
