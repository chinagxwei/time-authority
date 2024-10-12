export class Navigation {
  id?: number;

  parent_id?: number;

  navigation_name: string = "";

  navigation_link?: string = "";

  navigation_sort?: number = 0;

  menu_show?: number = 0;

  icon?: string = "";

  select?: boolean = false;

  created_at?: string;

  updated_at?: string;

  children?: Navigation[]
}

export class Role {

  id?: number;
  role_name: string = ""
  created_at?: string;
  updated_at?: string;
  navigations?: Navigation[]
}

export class SystemConfig {
  id?: number = 0;
  key: string = "";
  value?: string = "";
  created_at?: number = 0;
}

export class SystemAgreement {
  id?: number = 0;
  title: string = "";
  content: string = "";
  type: number = 0;
  show: number = 0;
  created_at?: number = 0;
}

export class SystemComplaint {
  id?: number = 0;
  title: string = "";
  content?: string = "";
  type?: number = 0;
  created_at?: number = 0;
}

export class SystemRouter{
  id?: number = 0;
  router_name: string = "";
  router: string = "";
  created_at?: number = 0;
}

export class RegisterRouter{
  uri: string = "";
  method: string = "";
}
