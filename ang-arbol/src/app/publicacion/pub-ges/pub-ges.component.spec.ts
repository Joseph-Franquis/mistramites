import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PubGesComponent } from './pub-ges.component';

describe('PubGesComponent', () => {
  let component: PubGesComponent;
  let fixture: ComponentFixture<PubGesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PubGesComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PubGesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
