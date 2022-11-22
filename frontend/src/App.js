import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Login from "./Component/Login";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import NeedAuth from "./Auth/NeedAuth";
import Home from "./Component/Home";
import Sidebar from "./Component/Sidebar";
import ChatRoom from "./Component/ChatRoom";

function App() {
    return (
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
    );
}

export default App;
