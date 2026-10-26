import { bijoyToUnicode, unicodeToBijoy } from './bijoy';

window.converter = () => ({
  mode: 'b2u', input: '', output: '', copied: false,

  convert() {
    this.output = this.mode === 'b2u'
      ? bijoyToUnicode(this.input)
      : unicodeToBijoy(this.input);
  },
  swap() {
    this.mode = this.mode === 'b2u' ? 'u2b' : 'b2u';
    [this.input, this.output] = [this.output, ''];
    this.convert();
  },
  clearAll() { this.input = this.output = ''; },
  async copy() {
    await navigator.clipboard.writeText(this.output);
    this.copied = true; setTimeout(() => this.copied = false, 1500);
  },
  download() {
    const blob = new Blob([this.output], { type: 'text/plain;charset=utf-8' });
    const a = Object.assign(document.createElement('a'), {
      href: URL.createObjectURL(blob), download: 'converted.txt',
    });
    a.click(); URL.revokeObjectURL(a.href);
  },
  async upload(e) {
    const file = e.target.files[0]; if (!file) return;
    if (file.name.endsWith('.txt')) {
      this.input = await file.text();
    } else if (file.name.endsWith('.docx')) {
      const fd = new FormData(); fd.append('file', file);
      const res = await fetch('/extract-docx', {
        method: 'POST', body: fd,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
      });
      this.input = (await res.json()).text;
    }
    this.convert();
  },
});