import axios from 'axios';

const URL_BASE = 'http://127.0.0.1:8000/api/';

function getConfig() {
    return {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${sessionStorage.getItem('token')}`,
        },
    };
}

async function request(method, path, body = null) {
    try {
        const config = getConfig();
        const response = await axios({
            method,
            url: `${URL_BASE}${path}`,
            data: body,
            ...config,
        });
        return response.data;
    } catch (error) {
        console.error(`Erro na requisição ${method} para ${path}:`, error);
        throw error;
    }
}

export function login(email, password) {
    return request('post', 'usuario/login', { email, password });
}

export function registrar(name, email, password) {
    return request('post', 'usuario/registrar', { name, email, password });
}

export function getDados(path) {
    return request('get', path);
}

export function postDados(path, body) {
    return request('post', path, body);
}

export function putDados(path, body) {
    return request('put', path, body);
}

export function deleteDados(path) {
    return request('delete', path);
}

export default axios;