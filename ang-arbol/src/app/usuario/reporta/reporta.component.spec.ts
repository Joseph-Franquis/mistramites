import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ReportaComponent } from './reporta.component';

describe('ReportaComponent', () => {
  let component: ReportaComponent;
  let fixture: ComponentFixture<ReportaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ReportaComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ReportaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
