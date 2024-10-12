import {Navigation, Role} from "./system";

export class User {
  access_token: string = "";

  token_type: string = "";

  expires_in: number = 0;

}

export class AuthenticationRequest {
  username: string = "";
  password: string = "";
  cellphone?: string = ""
}

export class ResetPasswordRequest {

  oldPassword: string = "";

  newPassword: string = "";

  validateNewPassword?: string = ""
}

export class UpdateUserInfoRequest {
  role_id?: number;
}

export class AdminInformation {
  id: string = ''
  enterprise_id: string = ''
  role_id: number = 0
  nickname: string = ''
  mobile: string = ''
  remark: string = ''
  created_at: string = ''
  navigations: Navigation[] = []
}

export class ActionLog {

  id?: number;

  user_id?: number = 0;

  action_name?: string = "";

  action_description?: string = "";

  updated_at?: string;

  created_at?: string
}

export class ManagerUserinfo {
  id?: number;
  created_at: string = ""
  email: string = "";
  updated_at: string = "";
  user_type: number = 0;
  username: string = "";
}

export class ServerManager {
  // @ts-ignore
  id: number;

  mobile: string = ""

  role_id?: number;
  role?: Role;

  creator?: ManagerUserinfo;

  updated_at: string = '';

  created_at: string = ''
}
