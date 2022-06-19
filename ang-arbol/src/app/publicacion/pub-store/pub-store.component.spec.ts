import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PubStoreComponent } from './pub-store.component';

describe('PubStoreComponent', () => {
  let component: PubStoreComponent;
  let fixture: ComponentFixture<PubStoreComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PubStoreComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PubStoreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
