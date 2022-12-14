import {useEffect, useState} from "react";
import useGetUserList from "../Hook/useGetUserList";
import useBuildTopicName from "../Hook/useBuildTopicName";
import {NavLink} from "react-router-dom";
import useGetCurrentUserUsername from "../Hook/useGetCurrentUserUsername";

export default function Home() {
    const getUserList = useGetUserList();
    //const getUsername = useGetCurrentUserUsername();
    const [users, setUsers] = useState([]);

    useEffect(() => {
        getUserList().then(data => {
            setUsers(data.users);
            console.log(data)
        })
    }, []);

    return (
        <div className='container' style={{height: '100vh', overflow: 'auto'}}>
            <h1 className='mb-3'>Listing users</h1>
            {users?.map((u) => (
                <div className='p-3 user rounded mb-3 mx-5' key={u.id}>
                    <NavLink to={`/chat/${(u.id)}`}
                             className='text-white text-decoration-none w-100 d-block text-center'>
                        {u.username}
                    </NavLink>
                </div>
            ))}
        </div>
    )
}