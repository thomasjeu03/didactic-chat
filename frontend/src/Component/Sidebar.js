import './Sidebar.css';
import {NavLink} from "react-router-dom";

export default function Sidebar() {
    return (
        <ul className="SideBar text-white nav mb-auto">
            <li className="nav-item">
                <NavLink to="/" className="nav-link text-white">
                    Chats
                </NavLink>
            </li>
            <li>
                <NavLink to="account" className="nav-link text-white">
                    Account
                </NavLink>
            </li>
            <li>
                <NavLink to="admin" className="nav-link text-white">
                    Admin
                </NavLink>
            </li>
        </ul>
    )
}