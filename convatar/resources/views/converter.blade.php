{{-- resources/views/converter.blade.php --}}
<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bijoy ⇄ Unicode Converter</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @font-face { font-family: 'SutonnyMJ'; src: url('/fonts/SutonnyMJ.ttf'); }
    .font-bijoy { font-family: 'SutonnyMJ', sans-serif; font-size: 1.15rem; }
    .btn { background:#2563eb; color:#fff; border:0; border-radius:.375rem; padding:.375rem .75rem;
           font-size:.875rem; font-weight:500; cursor:pointer; }
    .btn:hover { background:#1d4ed8; }
  </style>

  {{-- Must come BEFORE Alpine --}}
  <script>

// ================= Bijoy <-> Unicode core =================
// Mapping data adapted from github.com/zarif25/unicode-to-bijoy (no license file found; credit/ask before public release)
const U2B_MAP = [["।", "|"], ["‘", "Ô"], ["’", "Õ"], ["“", "Ò"], ["”", "Ó"], ["্র্য", "ª¨"], ["র‌্য", "i¨"], ["ক্ক", "°"], ["ক্ট", "±"], ["ক্ত", "³"], ["ক্ব", "K¡"], ["স্ক্র", "¯Œ"], ["ক্র", "µ"], ["ক্ল", "K¬"], ["ক্ষ", "¶"], ["ক্স", "·"], ["গু", "¸"], ["গ্ধ", "»"], ["গ্ন", "Mœ"], ["গ্ম", "M¥"], ["গ্ল", "M­"], ["গ্রু", "Mªy"], ["ঙ্ক", "¼"], ["ঙ্ক্ষ", "•¶"], ["ঙ্খ", "•L"], ["ঙ্গ", "½"], ["ঙ্ঘ", "•N"], ["চ্চ", "”P"], ["চ্ছ", "”Q"], ["চ্ছ্ব", "”Q¡"], ["চ্ঞ", "”T"], ["জ্জ্ব", "¾¡"], ["জ্জ", "¾"], ["জ্ঝ", "À"], ["জ্ঞ", "Á"], ["জ্ব", "R¡"], ["ঞ্চ", "Â"], ["ঞ্ছ", "Ã"], ["ঞ্জ", "Ä"], ["ঞ্ঝ", "Å"], ["ট্ট", "Æ"], ["ট্ব", "U¡"], ["ট্ম", "U¥"], ["ড্ড", "Ç"], ["ণ্ট", "È"], ["ণ্ঠ", "É"], ["ন্স", "Ý"], ["ণ্ড", "Ð"], ["ন্তু", "š‘"], ["ণ্ব", "Y^"], ["ত্ত", "Ë"], ["ত্ত্ব", "Ë¡"], ["ত্থ", "Ì"], ["ত্ন", "Zœ"], ["ত্ম", "Z¥"], ["ন্ত্ব", "š—¡"], ["ত্ব", "Z¡"], ["থ্ব", "_¡"], ["দ্গ", "˜M"], ["দ্ঘ", "˜N"], ["দ্দ", "Ï"], ["দ্ধ", "×"], ["দ্ব", "˜¡"], ["দ্ভ", "™¢"], ["দ্ম", "Ù"], ["দ্রু", "`ªæ"], ["ধ্ব", "aŸ"], ["ধ্ম", "a¥"], ["ন্ট", "›U"], ["ন্ঠ", "Ú"], ["ন্ড", "Û"], ["ন্ত্র", "š¿"], ["ন্ত", "šÍ"], ["স্ত্র", "¯¿"], ["ত্র", "Î"], ["ন্থ", "š’"], ["ন্দ", "›`"], ["ন্দ্ব", "›Ø"], ["ন্ধ", "Ü"], ["ন্ন", "bœ"], ["ন্ব", "š^"], ["ন্ম", "b¥"], ["প্ট", "Þ"], ["প্ত", "ß"], ["প্ন", "cœ"], ["প্প", "à"], ["প্ল", "cø"], ["প্স", "á"], ["ফ্ল", "d¬"], ["ব্জ", "â"], ["ব্দ", "ã"], ["ব্ধ", "ä"], ["ব্ব", "eŸ"], ["ব্ল", "eø"], ["ভ্র", "å"], ["ম্ন", "gœ"], ["ম্প", "¤ú"], ["ম্ফ", "ç"], ["ম্ব", "¤^"], ["ম্ভ", "¤¢"], ["ম্ভ্র", "¤£"], ["ম্ম", "¤§"], ["ম্ল", "¤­"], ["রু", "iæ"], ["রূ", "iƒ"], ["ল্ক", "é"], ["ল্গ", "ê"], ["ল্প", "í"], ["ল্ট", "ë"], ["ল্ড", "ì"], ["ল্ফ", "î"], ["ল্ব", "j¦"], ["ল্ম", "j¥"], ["ল্ল", "jø"], ["শু", "ï"], ["শ্চ", "ð"], ["শ্ন", "kœ"], ["শ্ব", "k¦"], ["শ্ম", "k¥"], ["শ্ল", "kø"], ["ষ্ক", "®‹"], ["ষ্ক্র", "®Œ"], ["ষ্ট", "ó"], ["ষ্ঠ", "ô"], ["ষ্ণ", "ò"], ["ষ্প", "®ú"], ["ষ্ফ", "õ"], ["ষ্ম", "®§"], ["স্ক", "¯‹"], ["স্ট", "÷"], ["স্খ", "ö"], ["স্ত", "¯Í"], ["স্তু", "¯‘"], ["স্থ", "¯’"], ["স্ন", "mœ"], ["স্প", "¯ú"], ["স্ফ", "ù"], ["স্ব", "¯^"], ["স্ম", "¯§"], ["স্ল", "¯­"], ["হু", "û"], ["হ্ণ", "nè"], ["হ্ন", "ý"], ["হ্ম", "þ"], ["হ্ল", "n¬"], ["হৃ", "ü"], ["র্", "©"], ["্র", "ª"], ["্য", "¨"], ["্", "&"], ["আ", "Av"], ["অ", "A"], ["ই", "B"], ["ঈ", "C"], ["উ", "D"], ["ঊ", "E"], ["ঋ", "F"], ["এ", "G"], ["ঐ", "H"], ["ও", "I"], ["ঔ", "J"], ["ক", "K"], ["খ", "L"], ["গ", "M"], ["ঘ", "N"], ["ঙ", "O"], ["চ", "P"], ["ছ", "Q"], ["জ", "R"], ["ঝ", "S"], ["ঞ", "T"], ["ট", "U"], ["ঠ", "V"], ["ড", "W"], ["ঢ", "X"], ["ণ", "Y"], ["ত", "Z"], ["থ", "_"], ["দ", "`"], ["ধ", "a"], ["ন", "b"], ["প", "c"], ["ফ", "d"], ["ব", "e"], ["ভ", "f"], ["ম", "g"], ["য", "h"], ["র", "i"], ["ল", "j"], ["শ", "k"], ["ষ", "l"], ["স", "m"], ["হ", "n"], ["ড়", "o"], ["ঢ়", "p"], ["য়", "q"], ["ৎ", "r"], ["০", "0"], ["১", "1"], ["২", "2"], ["৩", "3"], ["৪", "4"], ["৫", "5"], ["৬", "6"], ["৭", "7"], ["৮", "8"], ["৯", "9"], ["া", "v"], ["ি", "w"], ["ী", "x"], ["ু", "y"], ["ূ", "~"], ["ৃ", "…"], ["ে", "‡"], ["ৈ", "‰"], ["ৗ", "Š"], ["ং", "s"], ["ঃ", "t"], ["ঁ", "u"]];

const C  = '[\u0995-\u09B9\u09DC\u09DD\u09DF\u09CE]';   // consonants (incl. ড় ঢ় য় ৎ)
const HS = '\u09CD';                                    // hasanta (্)
const RA = '\u09B0';                                    // র
const CHAIN = `(?:${C}${HS})*${C}`;                     // ক্ষ / স্ত্র style conjunct
const esc = s => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

// ---------- Unicode -> Bijoy ----------
function unicodeToBijoy(text) {
  let s = text
    .replace(/\u09AF\u09BC/g, '\u09DF')   // য + ় -> য়
    .replace(/\u09A1\u09BC/g, '\u09DC')   // ড + ় -> ড়
    .replace(/\u09A2\u09BC/g, '\u09DD')   // ঢ + ় -> ঢ়
    .replace(/\u200d/g, '\u200c')
    .replace(/\u09CB/g, '\u09C7\u09BE')   // ো -> ে + া
    .replace(/\u09CC/g, '\u09C7\u09D7');  // ৌ -> ে + ৗ

  // 1) reph: র্ + cluster  ->  cluster + র্
  s = s.replace(new RegExp(`(?<!${HS})${RA}${HS}(${CHAIN})`, 'g'), '$1' + RA + HS);

  // 2) pre-base vowel signs go before the whole cluster (incl. its reph)
  s = s.replace(new RegExp(`(${CHAIN}(?:${RA}${HS}(?!${C}))?)([\u09BF\u09C7\u09C8])`, 'g'), '$2$1');

  // 3) map table (order matters: longest conjuncts first)
  for (const [u, b] of U2B_MAP) s = s.split(u).join(b);

  return s.replace(/\u200c/g, '');
}

// ---------- Bijoy -> Unicode (built from the same table) ----------
const B2U_MAP = (() => {
  const seen = new Set(), list = [];
  for (const [u, b] of U2B_MAP) {
    if (seen.has(b)) continue;
    seen.add(b);
    list.push([b, u.replace('\u200c', '\u200d')]);      // র‍্য uses ZWJ
  }
  // extra Bijoy variants seen in real documents
  list.push(['\u2020', '\u09C7']);                     // † -> ে
  list.sort((a, b) => b[0].length - a[0].length);       // longest match first
  return list;
})();
const B2U_LOOKUP = new Map(B2U_MAP);
const B2U_RE = new RegExp(B2U_MAP.map(([b]) => esc(b)).join('|'), 'g');

function bijoyToUnicode(text) {
  // 1) one-pass, longest-match mapping
  let s = text.replace(B2U_RE, m => B2U_LOOKUP.get(m));

  // 2) reph: cluster + র্  ->  র্ + cluster
  s = s.replace(new RegExp(`(${CHAIN})${RA}${HS}`, 'g'), RA + HS + '$1');

  // 3) pre-base vowel signs move after the cluster (incl. its reph)
  s = s.replace(new RegExp(`([\u09BF\u09C7\u09C8])((?:${RA}${HS})?${CHAIN})`, 'g'), '$2$1');

  // 4) split vowels join up: ে+া -> ো, ে+ৗ -> ৌ
  return s.replace(/\u09C7\u09BE/g, '\u09CB').replace(/\u09C7\u09D7/g, '\u09CC');
}


// ================= Alpine component =================
document.addEventListener('alpine:init', () => {
  Alpine.data('converter', () => ({
    mode: 'b2u', input: '', output: '', copied: false,

    convert() {
      this.output = this.mode === 'b2u'
        ? bijoyToUnicode(this.input)
        : unicodeToBijoy(this.input);
    },
    swap() {
      this.mode = this.mode === 'b2u' ? 'u2b' : 'b2u';
      this.input = this.output;
      this.convert();
    },
    clearAll() { this.input = ''; this.output = ''; },
    async copy() {
      if (!this.output) return;
      await navigator.clipboard.writeText(this.output);
      this.copied = true;
      setTimeout(() => this.copied = false, 1500);
    },
    download() {
      if (!this.output) return;
      const blob = new Blob([this.output], { type: 'text/plain;charset=utf-8' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url; a.download = 'converted.txt';
      document.body.appendChild(a); a.click(); a.remove();
      URL.revokeObjectURL(url);
    },
    async upload(e) {
      const file = e.target.files[0];
      if (!file) return;
      try {
        if (file.name.endsWith('.txt')) {
          this.input = await file.text();
        } else if (file.name.endsWith('.docx')) {
          const fd = new FormData();
          fd.append('file', file);
          const res = await fetch('/extract-docx', {
            method: 'POST', body: fd,
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
          });
          if (!res.ok) throw new Error('docx upload failed');
          this.input = (await res.json()).text;
        }
        this.convert();
      } catch (err) {
        alert('Could not read the file: ' + err.message);
      }
      e.target.value = '';
    },
  }));
});
  </script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 p-4">
<div x-data="converter" x-init="$watch('input', () => convert())" class="mx-auto max-w-5xl">
  <h1 class="mb-4 text-xl font-bold"
      x-text="mode === 'b2u' ? 'Bijoy → Unicode' : 'Unicode → Bijoy'"></h1>

  <div class="mb-3 flex flex-wrap items-center gap-2">
    <button type="button" @click="convert()" class="btn" >Convert</button>
     <!-- Swap -->
    <button
        type="button"
        @click="swap()"
        class="btn"
        x-text="mode === 'b2u' ? 'Unicode → Bijoy' : 'Bijoy → Unicode'"
    >
    </button>
    <button type="button" @click="clearAll()" class="btn">Clear</button>
    <input type="file" accept=".txt,.docx" @change="upload($event)" class="text-sm">
    <button type="button" @click="copy()" class="btn" x-text="copied ? 'Copied!' : 'Copy'"></button>
    <button type="button" @click="download()" class="btn">Download .txt</button>

  </div>

  <div class="grid gap-4 md:grid-cols-2">
    <textarea x-model="input" rows="12"
      class="w-full rounded border p-3"
      :class="mode === 'b2u' ? 'font-bijoy' : ''"
      placeholder="এখানে লেখা পেস্ট করুন"></textarea>

    <textarea readonly x-model="output" rows="12"
      class="w-full rounded border bg-white p-3"
      :class="mode === 'u2b' ? 'font-bijoy' : ''"></textarea>
  </div>

  <p class="mt-2 text-sm text-gray-600">
    Characters: <span x-text="output.length"></span> ·
    Words: <span x-text="output.trim() ? output.trim().split(/\s+/).length : 0"></span> ·
    Lines: <span x-text="output ? output.split('\n').length : 0"></span>
  </p>
</div>
</body>
</html>