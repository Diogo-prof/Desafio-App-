import React from 'react';
import { Link } from 'react-router-dom';

export default function Topbar(){
  const user = JSON.parse(localStorage.getItem('user')||'{}');
  return (
    <div className="flex items-center justify-between p-4 border-b border-white/10 bg-white/5">
      <div className="font-bold">VideoApp</div>
      <div className="flex items-center gap-4">
        <Link to="/" className="hover:underline">Dashboard</Link>
        <Link to="/library" className="hover:underline">Biblioteca</Link>
        <div className="text-sm text-slate-300">{user.name}</div>
      </div>
    </div>
  );
}
