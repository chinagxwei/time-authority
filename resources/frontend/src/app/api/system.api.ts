import {API_VERSION, HOST} from "../configs/config";

export const SYSTEM_API_MODULE = 'system';

/**
 * 角色列表
 */
export const ROLE_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/index`;

/**
 * 保存角色
 */
export const ROLE_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/save`;

/**
 * 角色详情
 */
export const ROLE_VIEW = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/view`;

/**
 * 删除角色
 */
export const ROLE_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/delete`;

/**
 * 搜索角色
 */
export const ROLE_SEARCH = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/search`;

/**
 * 配置菜单
 */
export const ROLE_CONFIG_NAVIGATION = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/set-navigation`;

/**
 * 配置路由
 */
export const ROLE_CONFIG_ROUTER = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/set-router`;

/**
 * 获取角色路由
 */
export const ROLE_GET_NAVIGATION = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/get-navigation-by-role`;

/**
 * 获取角色菜单
 */
export const ROLE_GET_ROUTER = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/role/get-router-by-role`;


/**
 * 导航列表
 */
export const NAVIGATION_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/navigation/index`;

/**
 * 保存导航
 */
export const NAVIGATION_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/navigation/save`;

/**
 * 删除导航
 */
export const NAVIGATION_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/navigation/delete`;

/**
 * 导航排序
 */
export const NAVIGATION_SORT = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/navigation/sort-change`;

/**
 * 根据父菜单获取导航数据
 */
export const NAVIGATION_FIND_BY_PARENT = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/navigation/find-by-parent`;

/**
 * 已注册导航列表
 */
export const NAVIGATION_REGISTERED = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/navigation/registered`;

/**
 * 所有导航
 */
export const NAVIGATION_ALL_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/navigation/all`;


/**
 * 管理员列表
 */
export const MANAGER_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/manager/index`;

/**
 * 管理员详情
 */
export const MANAGER_VIEW = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/manager/view`;


/**
 * 保存管理员信息
 */
export const MANAGER_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/manager/save`;

/**
 * 删除管理员
 */
export const MANAGER_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/manager/delete`;

/**
 * 管理员信息
 */
export const MANAGER_INFO = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/manager/info`;

/**
 * 管理员行为日志
 */
export const ACTION_LOG = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/log/index`;

/**
 * 配置列表
 */
export const CONFIG_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/config/index`;

/**
 * 保存配置
 */
export const CONFIG_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/config/save`;

/**
 * 删除配置
 */
export const CONFIG_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/config/delete`;

/**
 * 协议列表
 */
export const AGREEMENT_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/agreement/index`;

/**
 * 保存协议
 */
export const AGREEMENT_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/agreement/save`;

/**
 * 协议详情
 */
export const AGREEMENT_VIEW = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/agreement/view`;

/**
 * 删除协议
 */
export const AGREEMENT_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/agreement/delete`;

/**
 * 图片列表
 */
export const IMAGE_LISTS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/image/index`;

/**
 * 保存图片
 */
export const IMAGE_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/image/save`;

/**
 * 删除图片
 */
export const IMAGE_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/image/delete`;

/**
 * 单位列表
 */
export const UNIT_LIST = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/unit/index`;

/**
 * 保存单位
 */
export const UNIT_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/unit/save`;

/**
 * 单位详情
 */
export const UNIT_VIEW = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/unit/view`;

/**
 * 删除单位
 */
export const UNIT_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/unit/delete`;

/**
 * 标签列表
 */
export const TAG_LIST = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/tag/index`;

/**
 * 保存标签
 */
export const TAG_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/tag/save`;

/**
 * 标签详情
 */
export const TAG_VIEW = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/tag/view`;

/**
 * 删除标签
 */
export const TAG_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/tag/delete`;

/**
 * 投诉列表
 */
export const COMPLAINT_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/complaint/index`;

/**
 * 保存投诉
 */
export const COMPLAINT_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/complaint/save`;

/**
 * 投诉详情
 */
export const COMPLAINT_VIEW = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/complaint/view`;

/**
 * 删除投诉
 */
export const COMPLAINT_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/complaint/delete`;

/**
 * 路由列表
 */
export const ROUTER_ITEMS = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/router/index`;

/**
 * 保存路由
 */
export const ROUTER_SAVE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/router/save`;

/**
 * 删除路由
 */
export const ROUTER_DELETE = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/router/delete`;

/**
 * 系统路由
 */
export const ROUTER_SYSTEM_ITEM = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/router/system-router`;

/**
 * 已注册路由
 */
export const ROUTER_REGISTERED = `${HOST}/api/${API_VERSION}/${SYSTEM_API_MODULE}/router/registered-router`;

