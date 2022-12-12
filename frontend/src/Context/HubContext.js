import {createContext, useState} from 'react';

export const hubContext = createContext();

export default function HubProvider(props) {
    const [storedHub, setStoredHub] = useState('');

    return (
        <hubContext.Provider value={[storedHub, setStoredHub]}>
            {props.children}
        </hubContext.Provider>
    )
}