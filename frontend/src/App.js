import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Login from "./Component/Login";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import NeedAuth from "./Auth/NeedAuth";
import Home from "./Component/Home";
import Sidebar from "./Component/Sidebar";
import ChatRoom from "./Component/ChatRoom";
import UserProvider from './Context/UserContext';
import {useEffect} from "react";

function App() {

    return (
        <UserProvider>
            <BrowserRouter>
                <Routes>
                    <Route path={'/'} element={
                        <NeedAuth>
                            <Home/>
                        </NeedAuth>
                    }/>
                    <Route path='/login' element={<Login/>}/>
                    <Route path='/chat/:topic' element={
                        <NeedAuth>
                            <ChatRoom/>
                        </NeedAuth>
                    }/>
                </Routes>
                <Sidebar/>
            </BrowserRouter>
        </UserProvider>
    );
}

export default App;
