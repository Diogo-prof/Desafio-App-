import React, { useState } from 'react';
import api from '../api';

export default function Login(){
  const [email,setEmail]=useState('admin@example.com');
  const [password,setPassword]=useState('123456');
  const [error,setError]=useState('');

  const submit=async(e)=>{
    e.preventDefault(); setError('');
    try{
      const {data} = await api.post('/auth/login',{email,password});
      localStorage.setItem('token', data.token);
      localStorage.setItem('user', JSON.stringify(data.user));
      location.href = '/';
    }catch(err){ setError('Credenciais inválidas'); }
  };

  return (
    <div className="min-h-screen grid place-items-center">
      <div className="w-full max-w-md bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-8 shadow-2xl">
        <h1 className="text-3xl font-bold mb-2">Bem-vindo 👋</h1>
        <p className="text-slate-400 mb-6">Inicie sessão para continuar</p>
        <form onSubmit={submit} className="space-y-4">
          <div>
            <label className="block text-sm mb-1">Email</label>
            <input value={email} onChange={e=>setEmail(e.target.value)} type="email" required className="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 focus:outline-none"/>
          </div>
          <div>
            <label className="block text-sm mb-1">Password</label>
            <input value={password} onChange={e=>setPassword(e.target.value)} type="password" required className="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 focus:outline-none"/>
          </div>
          {error && <div className="text-red-400 text-sm">{error}</div>}
          <button className="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 transition font-semibold">Entrar</button>
        </form>
      </div>
    </div>
  );
}
