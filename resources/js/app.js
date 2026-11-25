import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  // FAQ accordion
  document.querySelectorAll('.faq-q').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const item = btn.closest('.faq-item');
      if (!item) return;
      const answer = item.querySelector('.faq-a');
      const plus = item.querySelector('.faq-plus');
      const isOpen = item.classList.contains('open');

      if (isOpen) {
        item.classList.remove('open');
        if (answer) answer.classList.add('hidden');
        if (plus) plus.textContent = '+';
      } else {
        item.classList.add('open');
        if (answer) answer.classList.remove('hidden');
        if (plus) plus.textContent = '−';
      }
    });
  });
  // Tabs (data-tab buttons + data-panel panels)
  document.querySelectorAll('[data-tab]').forEach(btn => {
    btn.addEventListener('click', () => {
      const group = btn.closest('[data-tabs]');
      if (!group) return;
      group.querySelectorAll('[data-tab]').forEach(b => {
        b.classList.remove('bg-[#10221C]', 'text-white', 'bg-[#B9975B]');
        b.classList.add('bg-white', 'text-[#10221C]');
      });
      btn.classList.add('bg-[#B9975B]', 'text-white');
      btn.classList.remove('bg-white');
      group.querySelectorAll('[data-panel]').forEach(p => p.classList.add('hidden'));
      const panel = group.querySelector('[data-panel="' + btn.dataset.tab + '"]');
      if (panel) panel.classList.remove('hidden');
    });
  });
  // Multi-step quiz / enquiry stepper
  const stepper = document.querySelector('[data-stepper]');
  if (stepper) {
    let step = 1;
    const total = parseInt(stepper.dataset.steps || '5', 10);
    const show = (n) => {
      stepper.querySelectorAll('[data-step]').forEach(s => s.classList.toggle('hidden', parseInt(s.dataset.step, 10) !== n));
      stepper.querySelectorAll('[data-step-label]').forEach(l => {
        const on = parseInt(l.dataset.stepLabel, 10) <= n;
        l.classList.toggle('bg-[#B9975B]', on);
        l.classList.toggle('text-white', on);
        l.classList.toggle('bg-neutral-200', !on);
        l.classList.toggle('text-[#10221C]', !on);
      });
    };
    stepper.querySelectorAll('.step-opt').forEach(opt => {
      opt.addEventListener('click', () => {
        const group = opt.closest('[data-opt-group]');
        if (group) group.querySelectorAll('.step-opt').forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
      });
    });
    stepper.querySelectorAll('[data-next]').forEach(b => b.addEventListener('click', () => { if (step < total) { step++; show(step); } }));
    stepper.querySelectorAll('[data-back]').forEach(b => b.addEventListener('click', () => { if (step > 1) { step--; show(step); } }));
    stepper.querySelectorAll('[data-finish]').forEach(b => b.addEventListener('click', () => { step = total; show(step); }));
    show(1);
  }
  // Mortgage calculator
  const calc = document.querySelector('[data-mortgage]');
  if (calc) {
    const fmt = n => 'AED ' + Math.round(n).toLocaleString('en-US');
    const run = () => {
      const price = parseFloat(calc.querySelector('[data-price]').value.replace(/[^0-9.]/g, '')) || 45000000;
      const downPct = parseFloat(calc.querySelector('[data-down-pct]').value) || 30;
      const years = parseFloat(calc.querySelector('[data-years]').value) || 25;
      const rate = parseFloat(calc.querySelector('[data-rate]').value) || 3.75;
      const down = price * downPct / 100;
      const loan = price - down;
      const r = rate / 100 / 12, n = years * 12;
      const monthly = r === 0 ? loan / n : loan * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);
      const set = (sel, v) => { const el = calc.querySelector(sel); if (el) el.textContent = v; };
      set('[data-out-down]', fmt(down) + ' (' + downPct + '%)');
      set('[data-out-loan]', fmt(loan));
      set('[data-out-monthly]', fmt(monthly));
      set('[data-out-total]', fmt(monthly * n));
    };
    calc.querySelectorAll('input, select').forEach(i => i.addEventListener('input', run));
    // No initial run(): the static figures shown are the Figma defaults (AED 165,550/month).
  }
});
