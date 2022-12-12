import {useEffect, useState} from "react";
import useGetUserList from "../Hook/useGetUserList";
import useBuildTopicName from "../Hook/useBuildTopicName";
import {NavLink} from "react-router-dom";
import useGetCurrentUserUsername from "../Hook/useGetCurrentUserUsername";
import useBackendPing from "../Hook/useBackendPing";
import {useNavigate} from "react-router-dom";


export default function Home() {
    const getUserList = useGetUserList();
    //const getUsername = useGetCurrentUserUsername();
    const [users, setUsers] = useState([]);

    // const backendPing = useBackendPing();

    const navigate = useNavigate(); 

    const handleSubmit = (e) => {
        e.preventDefault();
        const userId = e.target[0].value;
        navigate(`/chat/${userId}`, {replace: true});
        // backendPing(userId).then(data => console.log(data))
    }

    const handleMessage = (e) => {
        document.querySelector('h1').insertAdjacentHTML('afterend', '<div class="alert alert-success w-75 mx-auto">Ping !</div>');
        window.setTimeout(() => {
            const $alert = document.querySelector('.alert');
            $alert.parentNode.removeChild($alert);
        }, 2000);
        console.log(JSON.parse(e.data));
    }

    useEffect(() => {
        getUserList().then(data => {
            setUsers(data.user);
            console.log(data.user)
        })

        const url = new URL('http://127.0.0.1:1234/.well-known/mercure');
        url.searchParams.append('topic', 'my-private-topic');

        const eventSource = new EventSource(url, {withCredentials: true});
        eventSource.onmessage = handleMessage;

        return () => {
            eventSource.close()
        }
    }, []);

    return (
        <div className='container' style={{height: '100vh', overflow: 'auto'}}>
            <h1 className='mb-3'>Listing users</h1>
            {users?.map((u) => (
                <form className='p-3 user rounded mb-3 mx-5' key={u.id} onSubmit={handleSubmit}>
                     <button className='text-black text-decoration-none w-100 d-block text-center' value={u.id}>
                        {u.username}
                    </button>
                    {/* <NavLink to={`/chat/${(u.id)}`}
                             className='text-white text-decoration-none w-100 d-block text-center'>
                        {u.username}
                    </NavLink> */}
                </form>
            ))}
        </div>
    )
}