select id, sura, aya, no, arab, quran_simple_clean, arab_harokat, indonesia from terjemah_kata t where t.quran_simple_clean!=t.arab and concat(t.sura, ':', t.aya) > '0:00';

select id, sura, aya, no, arab, quran_simple_clean, arab_harokat, indonesia from terjemah_kata t where t.quran_simple_clean!=t.arab and concat(t.sura, ':', t.aya) >= '3:6';


select * from terjemah_kata t where t.quran_simple_clean!=t.arab and concat(t.sura, ':', t.aya) > '2:39';
