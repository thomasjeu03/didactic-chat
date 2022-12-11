import {useSelector} from "react-redux";
import {userContext} from "../Context/UserContext";
import {useContext} from "react";

export default function useGetCurrentUserUsername() {
    const storedUser = useContext(userContext);
    return JSON.parse(atob(storedUser.split('.')[1])).username;
}