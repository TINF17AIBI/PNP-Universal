using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;

namespace PnP_Universal.Models
{
    public partial class PnPContext : DbContext
    {
        public virtual DbSet<Adventure> Adventure { get; set; }
        public virtual DbSet<Hero> Hero { get; set; }
        public virtual DbSet<Templates> Templates { get; set; }
        public virtual DbSet<User> User { get; set; }

        public PnPContext(DbContextOptions<PnPContext> options) : base(options)
        { }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Adventure>(entity =>
            {
                entity.Property(e => e.Id).ValueGeneratedNever();

                entity.Property(e => e.Name)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Adventure)
                    .HasForeignKey<Adventure>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Adventure__Templ__29572725");

                entity.HasOne(d => d.Id1)
                    .WithOne(p => p.Adventure)
                    .HasForeignKey<Adventure>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Adventure__Gamem__286302EC");
            });

            modelBuilder.Entity<Hero>(entity =>
            {
                entity.Property(e => e.Id).ValueGeneratedNever();

                entity.Property(e => e.Inventory)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Name)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Stats)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Hero)
                    .HasForeignKey<Hero>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Hero__Adventure__2E1BDC42");

                entity.HasOne(d => d.Id1)
                    .WithOne(p => p.Hero)
                    .HasForeignKey<Hero>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Hero__Template__2D27B809");

                entity.HasOne(d => d.Id2)
                    .WithOne(p => p.Hero)
                    .HasForeignKey<Hero>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Hero__Owner__2C3393D0");
            });

            modelBuilder.Entity<Templates>(entity =>
            {
                entity.Property(e => e.Id).ValueGeneratedNever();

                entity.Property(e => e.Rules)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Templates)
                    .HasForeignKey<Templates>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Templates__Creat__25869641");
            });

            modelBuilder.Entity<User>(entity =>
            {
                entity.Property(e => e.Id).ValueGeneratedNever();

                entity.Property(e => e.Email)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Passwort)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Username)
                    .IsRequired()
                    .HasMaxLength(50);
            });
        }
    }
}
