import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConfigRouterComponent } from './config-router.component';

describe('ConfigRouterComponent', () => {
  let component: ConfigRouterComponent;
  let fixture: ComponentFixture<ConfigRouterComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ConfigRouterComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ConfigRouterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
