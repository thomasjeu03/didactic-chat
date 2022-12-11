import {createContext, useState} from 'react';

export const userContext = createContext();

export default function UserProvider(props) {
    const [storedUser, setStoredUser] = useState('');

    return (
        <userContext.Provider value={[storedUser, setStoredUser]}>
            {props.children}
        </userContext.Provider>
    )
}