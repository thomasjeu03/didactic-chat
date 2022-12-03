import {Navigate, useLocation} from "react-router-dom";
import {useContext} from "react";
import {userContext} from "../Context/UserContext"

export default function NeedAuth(props) {
    let location = useLocation();
    const [loggedUser, setLoggedUser] = useContext(userContext);

    if (loggedUser) {
        return props.children;
    } else {
        return <Navigate to='/login' state={{from: location}}/>
    }
}