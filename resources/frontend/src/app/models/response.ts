export class ServerResponse<T> {
  code: number = -1;
  message: string = "";
  data?: T;
}

export class Paginate<T> {
  current_page: number = 1;
  data: T[] = [];
  first_page_url: string = "";
  from: number = 1;
  last_page: number = 1;
  last_page_url: string = "";
  next_page_url?: string;
  path: string = "";
  per_page: number = 1;
  prev_page_url?: string
  to: number = 1;
  total: number = 1;
}
