import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConfigNavigationComponent } from './config-navigation.component';

describe('ConfigNavigationComponent', () => {
  let component: ConfigNavigationComponent;
  let fixture: ComponentFixture<ConfigNavigationComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ConfigNavigationComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ConfigNavigationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
