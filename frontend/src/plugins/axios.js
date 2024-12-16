import axios from 'axios';

// Cria uma instância do Axios
const axiosInstance = axios.create({
  baseURL: process.env.VUE_APP_API_URL, // Base URL para suas requisições
  timeout: 10000, // Tempo limite para requisições
  headers: {
    'Content-Type': 'application/json',
  },
});

// Interceptadores de requisição (opcional)
axiosInstance.interceptors.request.use(
  config => {
    // Adicione lógica antes da requisição (como tokens de autenticação)
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

// Interceptadores de resposta (opcional)
axiosInstance.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    // Lidar com erros globais
    console.error('Erro na resposta:', error);
    return Promise.reject(error);
  }
);

export default axiosInstance;
