import { TestBed } from '@angular/core/testing';

import {FileService} from "./file.service";

class ImageService {
}

describe('FileService', () => {
  let service: ImageService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(FileService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
