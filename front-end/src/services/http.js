import axios from 'axios';

const http = axios.create({
    baseURL: 'http://localhost:8000',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    withCredentials: true 
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

http.interceptors.request.use(config => {
    const token = getCookie('XSRF-TOKEN');
    
    if (token) {
        config.headers['X-XSRF-TOKEN'] = decodeURIComponent(token);
    }
    
    return config;
});

export default http;