import {useContext, useState} from "react";
import {useDispatch, useSelector} from "react-redux";
import {LoginAction} from "../Action/LoginAction";
import {useLocation, useNavigate} from "react-router-dom";
import {Connect} from "../Action/WebsocketAction";
import useGetJWT from "../Hook/useGetJWT";
import {userContext} from "../Context/UserContext";

export default function Login() {
    const navigate = useNavigate();
    let location = useLocation();
    let from = location.state?.from?.pathname || '/';


    const getJWT = useGetJWT();

    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [storedUser, setStoredUser] = useContext(userContext);


    const handleUsername = (e) => {
        setUsername(e.target.value);
    }
    const handlePassword = (e) => {
        setPassword(e.target.value);
    }
    const handleSubmit = (e) => {
        e.preventDefault();
        getJWT(username, password).then(data => {
            if (data) {
                const user = {
                    'user': data.user, 
                    'jwt': data.jwt
                }
                console.log(user);
                setStoredUser(user);
                navigate(from, {replace: true});
            } else {
                console.log('no data jwt');
                console.log(data);
            }
        });
    }

    return (
        <div className='container'>
            <h1>Currently logged in as </h1>

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label htmlFor="username" className="form-label">Username</label>
                    <input type="text" className="form-control" id="username" onChange={handleUsername} value={username}/>
                </div>
                <div className="mb-3">
                    <label htmlFor="password" className="form-label">Password</label>
                    <input type="password" className="form-control" id="password" onChange={handlePassword}
                           value={password}/>
                </div>
                <button type="submit" className="btn btn-primary">Submit</button>
            </form>
        </div>
    )
}
