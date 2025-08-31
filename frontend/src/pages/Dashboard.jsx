import React, { useEffect, useState } from 'react';
import api from '../api';
import Topbar from '../components/Topbar';

export default function Dashboard(){
  const [m,setM]=useState(null);
  useEffect(()=>{ api.get('/dashboard/metrics').then(r=>setM(r.data.metrics)); },[]);
  return (
    <div>
      <Topbar/>
      <div className="p-6 grid md:grid-cols-4 gap-4">
        {m ? (
          <>
            <Card title="Utilizadores" value={m.total_users}/>
            <Card title="Itens Biblioteca" value={m.total_items}/>
            <Card title="Vídeos" value={m.total_videos}/>
            <Card title="Tempo Assistido (s)" value={m.total_seconds_watched}/>
          </>
        ) : <div>Carregando…</div>}
      </div>
    </div>
  );
}

function Card({title,value}){
  return (
    <div className="bg-white/5 rounded-2xl p-6 border border-white/10">
      <div className="text-slate-400 text-sm">{title}</div>
      <div className="text-3xl font-bold mt-2">{value}</div>
    </div>
  );
}
