import {Navigate, useLocation} from "react-router-dom";
import {useSelector} from "react-redux";
import {useContext} from "react";
import {userContext} from "../Context/UserContext";

export default function NeedAuth(props) {
    let location = useLocation();
    const [loggedUser, storedUser] = useContext(userContext);

    if (loggedUser) {
        return props.children;
    } else {
        return <Navigate to='/login' state={{from: location}}/>
    }
}