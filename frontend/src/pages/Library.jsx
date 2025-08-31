import React, { useEffect, useState } from 'react';
import api from '../api';
import Topbar from '../components/Topbar';
import { Link } from 'react-router-dom';

export default function Library(){
  const [items,setItems]=useState([]);
  useEffect(()=>{ api.get('/library').then(r=>setItems(r.data.items)); },[]);
  return (
    <div>
      <Topbar/>
      <div className="p-6 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {items.map(it=> (
          <div key={it.id} className="bg-white/5 rounded-2xl overflow-hidden border border-white/10">
            <img src={it.thumbnail_url} alt="thumb" className="w-full aspect-video object-cover"/>
            <div className="p-4">
              <div className="font-semibold line-clamp-1">{it.title}</div>
              <div className="text-sm text-slate-400 line-clamp-2 mt-1">{it.description}</div>
              <div className="mt-3 flex justify-between items-center">
                <span className="text-xs bg-white/10 px-2 py-1 rounded-full">{it.category}</span>
                <Link to={`/video/${it.id}`} className="text-indigo-400 hover:underline">Ver</Link>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
