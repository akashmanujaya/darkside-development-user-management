import axios from "axios";

const BASE_URL = "/admin/customer-management/api";

export const getCustomers = async () => {
    return await axios.get(`${BASE_URL}/customers`);
};

export const createCustomer = async (data) => {
    return await axios.post(`${BASE_URL}/customer`, data);
};

export const updateCustomer = async (id, data) => {
    return await axios.put(`${BASE_URL}/customer/${id}`, data);
};
