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
