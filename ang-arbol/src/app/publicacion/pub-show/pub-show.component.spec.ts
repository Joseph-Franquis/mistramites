import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PubShowComponent } from './pub-show.component';

describe('PubShowComponent', () => {
  let component: PubShowComponent;
  let fixture: ComponentFixture<PubShowComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PubShowComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PubShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
