import React from 'react';
import ReactDOM from 'react-dom/client';
import App from "./App";

// Je pointe le DOM de react vers la balise root pour le dashboard
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <React.StrictMode>
            <App />
    </React.StrictMode>
);
