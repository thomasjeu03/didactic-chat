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
            setUsers(data.user);
        })
    }, []);

    return (
        <div className='container' style={{height: '100vh', overflow: 'auto'}}>

            <h1 className='mb-3'>Listing users</h1>
            {users?.map((user) => (
                <div className='p-3 user rounded mb-3 mx-5' key={user.id}>
                    <NavLink to={`/chat/${(user.id)}`}
                             className='text-white text-decoration-none w-100 d-block text-center'>
                        {user.username}
                    </NavLink>
                </div>
            ))}
        </div>
    )
}