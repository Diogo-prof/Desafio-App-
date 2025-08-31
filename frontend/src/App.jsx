import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import Login from './pages/Login';
import Dashboard from './pages/Dashboard';
import Library from './pages/Library';
import Video from './pages/Video';

const Private = ({children})=>{
  const token = localStorage.getItem('token');
  return token ? children : <Navigate to="/login" replace />;
};

export default function App(){
  return (
    <Routes>
      <Route path="/login" element={<Login/>} />
      <Route path="/" element={<Private><Dashboard/></Private>} />
      <Route path="/library" element={<Private><Library/></Private>} />
      <Route path="/video/:id" element={<Private><Video/></Private>} />
      <Route path="*" element={<Navigate to="/"/>} />
    </Routes>
  );
}
