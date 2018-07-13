import axios from 'axios';

const baseURL = $('meta[name="base-url"]').attr('content');
const headers = {
    'X-CSRF-TOKEN'    : $('meta[name="csrf-token"]').attr('content'),
    'X-Requested-With': 'XMLHttpRequest',
};

const http = axios.create({
    baseURL,
    headers,
});

export default http;
