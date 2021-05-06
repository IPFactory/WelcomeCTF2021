create database users;
use users;
create table user (
    name char(50),
    pass char(50)
);
insert into user values ("admin", "P@ssw0rd"); 
insert into user values ("root", "toor"); 
insert into user values ("yoden", "Svp3rS3cvr3P4sswr0d!!!");
insert into user values ("y0d3n", "v3ryS3cvr3P4sswr0d!!!"); 
insert into user values ("user1", "123456"); 
insert into user values ("qwaerty", "qawsedrftgyhujikolp"); 


create table flag (
    fl4g char(50)
);
insert into flag values ("flag{sql_1nj3ct10n_c4n_l00k_4t_0th3r_t4bl3s}"); 

GRANT SELECT ON *.* TO 'y0d3n'@'%';
