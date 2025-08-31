import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import api from '../api';
import Topbar from '../components/Topbar';

export default function Video(){
  const { id } = useParams();
  const [video,setVideo]=useState(null);
  useEffect(()=>{
    api.get('/videos').then(r=>{
      const v = r.data.videos.find(v=> String(v.library_item_id)===String(id)) || r.data.videos[0];
      setVideo(v);
    });
  },[id]);
  return (
    <div>
      <Topbar/>
      <div className="p-6 max-w-5xl mx-auto">
        {video ? (
          <div className="bg-white/5 rounded-2xl p-4 border border-white/10">
            <video className="w-full rounded-xl" src={video.video_url} poster={video.thumbnail_url} controls />
            <h1 className="text-2xl font-bold mt-4">{video.title}</h1>
            <p className="text-slate-300 mt-1">{video.description}</p>
          </div>
        ) : 'Carregando…'}
        <div className="mt-4"><Link to="/library" className="text-indigo-400 hover:underline">← Voltar</Link></div>
      </div>
    </div>
  );
}

