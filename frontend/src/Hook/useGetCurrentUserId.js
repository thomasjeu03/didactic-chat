import {useSelector} from "react-redux";
import {useContext} from "react";
import { userContext } from "../Context/UserContext";

export default function useGetCurrentUserId() {
    const storedUser = useContext(userContext);
    return storedUser.id;
}