import {API_VERSION, HOST} from "../configs/config";

/**
 * 用户登录
 */
export const USER_LOGIN = `${HOST}/api/${API_VERSION}/auth/login`;
/**
 * 用户登出
 */
export const USER_LOGOUT = `${HOST}/api/${API_VERSION}/auth/logout`;
/**
 * 修改密码
 */
export const USER_RESET_PASSWORD = `${HOST}/api/${API_VERSION}/auth/reset-password`;


export const USER_SIMPLE_INFO = `${HOST}/api/${API_VERSION}/auth/info`;
